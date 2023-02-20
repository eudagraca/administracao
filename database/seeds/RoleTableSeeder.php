<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recurosHumanos = new Role();
        $recurosHumanos->slug = 'gestor-recursos-humanos';
        $recurosHumanos->name = 'Gestor de Recursos Humanos';
        $recurosHumanos->save();

        $manager_role = new Role();
        $manager_role->slug = 'super-admin';
        $manager_role->name = 'Super Admim';
        $manager_role->save();

        $manager_role = new Role();
        $manager_role->slug = 'usuario-normal';
        $manager_role->name = 'Usuário normal ';
        $manager_role->save();

        $manager_role = new Role();
        $manager_role->slug = 'gestor-administracao';
        $manager_role->name = 'Gestor Administrativo';
        $manager_role->save();

        $manager_role = new Role();
        $manager_role->slug = 'gestor-manutencao';
        $manager_role->name = 'Gestor da área de manutenção ';
        $manager_role->save();

    }
}
