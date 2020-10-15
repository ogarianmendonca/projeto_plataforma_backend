<?php

namespace App\Repositories;

use App\Entities\Pessoa;
use App\Entities\User;
use App\Interfaces\UsuarioInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsuarioRepository
 * @package App\Repositories
 */
class UsuarioRepository implements UsuarioInterface
{
    /**
     * @var User
     */
    private $usuario;

    /**
     * UsuarioRepository constructor.
     *
     * @param User $usuario
     */
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return User::with(['roles', 'pessoa'])->get();
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @return User|mixed
     * @throws Exception
     */
    public function create($params)
    {
        try {
            $novoUsuario = new User();
            $novoUsuario->name = $params->name;
            $novoUsuario->email = $params->email;
            $novoUsuario->status = true;
            $novoUsuario->password = Hash::make($params->password);
            $novoUsuario->image = $params->image == null ? 'sem_imagem' : $params->image;

            $novoUsuario->save();
            $novoUsuario->roles()->attach($params->roles);

            return $novoUsuario;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function getById($id)
    {
        try {
            return User::with(['roles', 'pessoa'])->find($id);
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function update($params, $id)
    {
        try {
            $usuario = User::find($id);
            $usuario->name = $params->name;
            $usuario->email = $params->email;
            $usuario->status = $params->status;

            if ($params->password) {
                Hash::make($params->password);
            } else {
                unset($params->password);
            }

            if (!empty($params->image)) {
                $usuario->image = $params->image;
            }

            $usuario->save();
            if ($params->roles) {
                $usuario->roles()->sync($params->roles);
            }

            return $usuario;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function delete($id)
    {
        try {
            $usuario = User::find($id);
            $usuario->delete();

            $pessoa = Pessoa::where('usuario_id', $usuario->id)->first();
            if ($pessoa) {
                $pessoa->delete();
            }

            return $usuario;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function upload($dadosArquivo): string
    {
        if ($dadosArquivo->hasFile('image')) {
            $imagem = $dadosArquivo->file('image');
            $ext = $imagem->guessClientExtension();
            $data = file_get_contents($imagem);
            return 'data:image/' . $ext . ';base64,' . base64_encode($data);
        } else {
            return 'sem_imagem';
        }
    }
}
