<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAvatar;
use App\Http\Requests\UpdateProfile;
use App\User;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
     * @param string|null $form
     * @return \Illuminate\Http\Response
     */
    public function index(?string $form = null)
    {
        return view('profile', [
            'breadcrumbs' => [
                ['label' => 'Dados Cadastrais']
            ],
            'form' => $form
        ]);
    }

    public function update(UpdateProfile $request)
    {

        $user = Auth::user();

        $user->fill($request->all());
        $user->save();

        return redirect('profile')->with('success', 'Dados alterados com sucesso');
    }

    public function changePassword(Request $request)
    {
        if (!\Hash::check($request->input('old_password'), Auth::user()->getAuthPassword())) {
            return redirect('profile')->with('error', 'A senha atual é inválida.');
        }

        if (empty($request->input('new_password'))) {
            return redirect('profile')->with('error', 'Digite a nova senha');
        }

        if ($request->input('new_password') !== $request->input('repeat_password')) {
            return redirect('profile')->with('error', 'As senhas digitadas são diferentes');
        }

        $user = Auth::user();
        $user->password = \Hash::make($request->input('new_password'));
        $user->save();

        return redirect('profile')->with('success', 'Senha alterada com sucesso!');

    }

    /**
     * @param string|null $size
     * @param Client $httpClient
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function avatar(Client $httpClient, ?string $size = null)
    {
        $id = Auth::user()->id;
        $path = $size === 'small' ? "avatar/$id.small.png" : "avatar/$id.png";
        $disk = \Storage::disk('local');
        if (!$disk->exists($path)) {
            $userName = Auth::user()->name;
            $imageSize = $size === 'small' ? 50 : 140;
            $response = $httpClient->get("https://ui-avatars.com/api/?name=$userName&size=$imageSize&background=0D8ABC&color=fff");
            $disk->put($path, $response->getBody()->getContents());
        }
        $type = $disk->mimeType($path);
        $content = $disk->get($path);
        return response($content)->header('Content-Type', $type);
    }

    public function userAvatar(Client $httpClient, User $user, ?string $size = null)
    {
        $path = $size === 'small' ? "avatar/{$user->id}.small.png" : "avatar/{$user->id}.png";
        $disk = \Storage::disk('local');
        if (!$disk->exists($path)) {
            $userName = $user->name;
            $imageSize = $size === 'small' ? 50 : 140;
            $response = $httpClient->get("https://ui-avatars.com/api/?name=$userName&size=$imageSize&background=0D8ABC&color=fff");
            $disk->put($path, $response->getBody()->getContents());
        }
        $type = $disk->mimeType($path);
        $content = $disk->get($path);
        return response($content)->header('Content-Type', $type);
    }

    public function changeAvatar(ChangeAvatar $request)
    {
        $userId = Auth::user()->id;

        $image = \Image::make($request->avatar);
        $width = $image->width();
        $height = $image->height();

        $bigFactor = 140 / max($width, $height);
        $bigImage = clone $image;
        $bigImage->resize($width * $bigFactor, $height * $bigFactor);
        $bigImage->resizeCanvas(140, 140);
        $smallFactor = 50 / max($width, $height);
        $smallImage = clone $image;
        $smallImage->resize($width * $smallFactor, $height * $smallFactor);
        $smallImage->resizeCanvas(50, 50);

        $bigPath = "avatar/$userId.png";
        $smallPath = "avatar/$userId.small.png";

        $disk = \Storage::disk('local');
        $disk->put($bigPath, $bigImage->encode('png'));
        $disk->put($smallPath, $smallImage->encode('png'));

        return redirect('profile')->with('success', 'Imagem alterada com sucesso!');

    }
}
