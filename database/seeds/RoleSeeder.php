<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role1 = Role::create(['name' => 'Admin']);
        $Role2 = Role::create(['name' => 'Directivo']);

        Permission::create(['name' => 'panel', 'description' => 'ver panel administrativo'])->syncRoles([$Role1, $Role2]);

        //Permisos Socios
        Permission::create(['name' => 'partners.index', 'description' => 'ver panel de Socios'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'partners', 'description' => 'crear, editar y eliminar Socios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'asignar.directivo', 'description' => 'asignar cargo a directivos'])->syncRoles([$Role1]);
        Permission::create(['name' => 'vistaDirectivo', 'description' => 'ver panel de directivos'])->syncRoles([$Role1, $Role2]);
        //Permisos Socios Fallecidos
        Permission::create(['name' => 'sociosFallecidos_pdf', 'description' => 'ver lista de socios falecidos'])->syncRoles([$Role1, $Role2]);
        //Permission::create(['name' => 'partners.index', 'description' => 'ver panel de Socios'])->syncRoles([$Role1, $Role2]);
        //Permission::create(['name' => 'partners.index', 'description' => 'ver panel de Socios'])->syncRoles([$Role1, $Role2]);
        //Permission::create(['name' => 'partners.index', 'description' => 'ver panel de Socios'])->syncRoles([$Role1, $Role2]);
        //Permisos Resumen Socio
        Permission::create(['name' => 'resumenSocio', 'description' => 'ver resumen de Socio'])->syncRoles([$Role1, $Role2]);
        

        //Permisos Registro de pagos
        Permission::create(['name' => 'payments', 'description' => 'registrar pagos'])->syncRoles([$Role1]);
        Permission::create(['name' => 'listaPagos', 'description' => 'ver pagos'])->syncRoles([$Role1, $Role2]);

        //Permisos productos
        Permission::create(['name' => 'products.index', 'description' => 'ver categorías de productos'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'products', 'description' => 'crear, editar y eliminar categorías de productos'])->syncRoles([$Role1]);


        //Permisos Opciones de Productos
        Permission::create(['name' => 'option_products.index', 'description' => 'ver productos'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'option_products', 'description' => 'crear, editar y eliminar productos'])->syncRoles([$Role1]);
        Permission::create(['name' => 'option_products.create_buys', 'description' => 'comprar productos'])->syncRoles([$Role1]);
        Permission::create(['name' => 'buys_products.anular', 'description' => 'anular compras de productos'])->syncRoles([$Role1]);
        

        //Permisos Servicios
        Permission::create(['name' => 'services.index', 'description' => 'ver categorías de servicios'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'services', 'description' => 'crear, editar y eliminar categorías de servicios'])->syncRoles([$Role1]);

        //Permisos Opciones de Servicios
        Permission::create(['name' => 'option_services.index', 'description' => 'ver servicios'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'option_services', 'description' => 'crear, editar y eliminar servicios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'option_services.create_buys', 'description' => 'comprar servicios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'buys_services.anular', 'description' => 'anular compras de servicios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'recepcionEntrega', 'description' => 'recepcionar entrega de servicios de beneficio entregado'])->syncRoles([$Role1]);        


        //Permisos Proveedores
        Permission::create(['name' => 'providers.index', 'description' => 'ver proveedores'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'providers', 'description' => 'crear, editar y eliminar proveedores'])->syncRoles([$Role1]); //Solo ver listado


        //Permisos Usuarios
        Permission::create(['name' => 'users.index', 'description' => 'ver usuarios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'users', 'description' => 'crear, editar y eliminar usuarios'])->syncRoles([$Role1]);


        //Permisos Roles
        Permission::create(['name' => 'roles.index', 'description' => 'ver roles'])->syncRoles([$Role1]);
        Permission::create(['name' => 'roles', 'description' => 'crear, editar y eliminar roles'])->syncRoles([$Role1]);


        //Permisos Entrega de beneficio
        Permission::create(['name' => 'entrega', 'description' => 'entregar beneficio'])->syncRoles([$Role1]);
    }
}
