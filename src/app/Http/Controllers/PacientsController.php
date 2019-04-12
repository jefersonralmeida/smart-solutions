<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\CreatePatient;
use App\Http\Requests\Patient\UpdatePatient;
use App\Patient;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PacientsController extends Controller
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
     * @param Patient $patient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Patient $patient)
    {
        return view('patients.index', [
            'breadcrumbs' => [
                ['label' => 'Pacientes', 'route' => 'patients']
            ],
            'patients' => collect([$patient])
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = Patient::query();

        // if it's a search request, include the search conditions
        $search = request()->input('q');
        if (!empty($search)) {
            $search = sanitizeString($search);
            $query->where(function (Builder $query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
                $query->orWhere('email', 'like', "%{$search}%");
            });
        }

        /** @var Collection|Patient[] $patients */
        $patients = $query->get();

        return view('patients.index', [
            'breadcrumbs' => [
                ['label' => 'Pacientes', 'route' => 'patients']
            ],
            'patients' => $patients,
            'query' => $search
        ]);
    }

    public function create()
    {
        return view('patients.form', [
            'breadcrumbs' => [
                ['label' => 'Pacientes', 'route' => 'patients'],
                ['label' => 'Novo'],
            ],
            'action' => route('patients.store'),
            'method' => 'post',
        ]);
    }

    /**
     * @param CreatePatient $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(CreatePatient $request)
    {

        // creating the patient
        $patient = new Patient();
        $patient->fill($request->all());
        $patient->clinic_id = Auth::user()->clinic->id;
        $patient->save();


        return redirect(route('patients.view', ['patient' => $patient->id]));

    }

    /**
     * @param Patient $patient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Patient $patient)
    {

        return view('patients.form', [
            'breadcrumbs' => [
                ['label' => 'Pacientes', 'route' => 'patients'],
                ['label' => "Alterar ($patient->name)"],
            ],
            'patient' => $patient,
            'action' => route('patients.update', ['patient' => $patient->id]),
            'method' => 'put',
        ]);
    }

    /**
     * @param Patient $patient
     * @param UpdatePatient $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Patient $patient, UpdatePatient $request)
    {
        $patient->fill($request->all());

        $patient->save();
        return redirect(route('patients.view', ['patient' => $patient->id]));
    }

    /**
     * @param Patient $patient
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect(route('patients'));
    }

    /**
     * @param Patient $deletedPatient
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore(Patient $deletedPatient)
    {
        $deletedPatient->restore();
        return redirect(route('patients.view', [$deletedPatient->id]));
    }

}
