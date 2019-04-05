<?php

namespace App\Http\Controllers;

use App\Dentist;
use App\Http\Requests\Dentist\CreateDentist;
use App\Http\Requests\Dentist\UpdateDentist;
use App\Jobs\CheckCroJob;
use App\User;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DentistsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = Dentist::where('clinic_id', Auth::user()->clinic->id);

        // if it's a search request, include the search conditions
        $search = request()->input('q');
        if (!empty($search)) {
            $search = str_replace('-', '', strtoupper(trim($search)));
            $query->where(function (Builder $query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
                $query->orWhere('email', 'like', "%{$search}%");
                $query->orWhere('cro', $search);
            });
        }

        /** @var Collection|Dentist[] $dentists */
        $dentists = $query->get();

        return view('dentists.index', [
            'breadcrumbs' => [
                ['label' => 'Dentistas']
            ],
            'dentists' => $dentists,
            'query' => $search
        ]);
    }

    public function create()
    {

        $users = User::where(['clinic_id' => Auth::user()->clinic->id])->get();

        return view('dentists.form', [
            'breadcrumbs' => [
                ['label' => 'Dentistas', 'route' => 'dentists'],
                ['label' => 'Novo'],
            ],
            'users' => $users,
            'action' => route('dentists.store'),
            'method' => 'post',
        ]);
    }

    /**
     * @param CreateDentist $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(CreateDentist $request)
    {

        // ensure that name and email are empty when the user_id is set
        if ($request->user_id) {
            $request->name = null;
            $request->email = null;
        }

        DB::beginTransaction();

        // creating the dentist
        $dentist = new Dentist();
        $dentist->fill($request->all());
        $dentist->clinic_id = Auth::user()->clinic->id;
        $dentist->save();

        // linking it to user if user_id is provided
        if ($request->user_id) {
            /** @var User $user */
            $user = User::where('id', $request->user_id)->first();
            $user->dentist_id = $dentist->id;
            $user->save();
        }
        DB::commit();

        CheckCroJob::dispatch($dentist, Auth::user());

        return redirect(route('dentists', ['q' => $dentist->cro]));

    }

    /**
     * @param Dentist $dentist
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Dentist $dentist)
    {
        $users = User::where(['clinic_id' => Auth::user()->clinic->id])->get();

        return view('dentists.form', [
            'breadcrumbs' => [
                ['label' => 'Dentistas', 'route' => 'dentists'],
                ['label' => "Alterar ($dentist->name)"],
            ],
            'dentist' => $dentist,
            'users' => $users,
            'action' => route('dentists.update', ['dentist' => $dentist->id]),
            'method' => 'put',
        ]);
    }

    /**
     * @param Dentist $dentist
     * @param UpdateDentist $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Dentist $dentist, UpdateDentist $request)
    {
        $dentist->fill($request->all());
        if ($dentist->getOriginal('cro') !== $dentist->cro) {
            $dentist->cro_status = "W";
            $dentist->cro_status_message = "";
            $dentist->cro_dispatched_at = now();
        }
        $dentist->save();
        CheckCroJob::dispatch($dentist, Auth::user());
        return redirect(route('dentists', ['q' => $dentist->cro]));
    }

    /**
     * @param Dentist $dentist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Dentist $dentist)
    {
        $dentist->delete();
        return redirect(route('dentists'));
    }

    /**
     * @param Dentist $dentist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function dispatchCroValidation(Dentist $dentist)
    {
        $dentist->cro_status = "W";
        $dentist->cro_status_message = "";
        $dentist->cro_dispatched_at = now();
        $dentist->save();
        CheckCroJob::dispatch($dentist, Auth::user());
        return redirect(route('dentists', ['q' => $dentist->cro]));
    }
}
