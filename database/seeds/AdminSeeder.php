<?php

use App\Permission;
use App\Role;
use App\Sector;
use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recursos_role = Role::where('slug', 'gestor-recursos-humanos')->first();
        $gestor_administracao_role = Role::where('slug', 'gestor-administracao')->first();
        $usuario_normal_role = Role::where('slug', 'usuario-normal')->first();
        $super_admin_role = Role::where('slug', 'super-admin')->first();
        $manutencao_role = Role::where('slug', 'gestor-manutencao')->first();

        $super_usuario = new User();
        $super_usuario->name = 'Manager';
        $super_usuario->email = 'manager@teste.com';
        $super_usuario->username = 'manage.com';
        $super_usuario->password = bcrypt('manager');
        $super_usuario->save();
        $super_usuario->roles()->attach($super_admin_role);

        $sector = new Sector();
        $sector->user_id = $super_usuario->id;
        $sector->user_id = "Geral";
        $super_usuario->sector()->attach($sector);


        $administracao = new User();
        $administracao->name = 'Administracao';
        $administracao->email = 'administracao@teste.com';
        $administracao->username = 'administracao.com';
        $administracao->password = bcrypt('administracao');
        $administracao->save();
        $administracao->roles()->attach($gestor_administracao_role);

        $usuario_normal = new User();
        $usuario_normal->name = 'Usuario';
        $usuario_normal->email = 'usuario@teste.com';
        $usuario_normal->username = 'usuario.com';
        $usuario_normal->password = bcrypt('usuario');
        $usuario_normal->save();
        $usuario_normal->roles()->attach($usuario_normal_role);

        $recursosH = new User();
        $recursosH->name = 'Recursos H';
        $recursosH->email = 'recursosh@teste.com';
        $recursosH->username = 'recursosh.com';
        $recursosH->password = bcrypt('recursos');
        $recursosH->save();
        $recursosH->roles()->attach($recursos_role);

        $manutencao = new User();
        $manutencao->name = 'Manutencao';
        $manutencao->email = 'manutencao@teste.com';
        $manutencao->username = 'manutencao.com';
        $manutencao->password = bcrypt('manutencao');
        $manutencao->save();
        $manutencao->roles()->attach($manutencao_role);

    }
}
