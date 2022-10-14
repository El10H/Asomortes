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

        Permission::create(['name' => 'panel'])->syncRoles([$Role1, $Role2]);

        //Permisos productos
        Permission::create(['name' => 'products'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'products.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'products.destroy'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'products.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'products.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'products.pdf'])->syncRoles([$Role1, $Role2]);

        //Permisos Opciones de Productos
        Permission::create(['name' => 'option_products'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_products.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_products.destroy'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_products.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_products.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_products.pdf'])->syncRoles([$Role1, $Role2]);
        //Permisos Compras de Opciones de Productos
        Permission::create(['name' => 'option_products.create_buys'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'buys_products.pdf'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'buys_products.anular'])->syncRoles([$Role1]);

        //Permisos Servicios
        Permission::create(['name' => 'services'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'services.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'services.destroy'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'services.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'services.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'services.pdf'])->syncRoles([$Role1, $Role2]);

        //Permisos Opciones de Servicios
        Permission::create(['name' => 'option_services'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_services.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_services.destroy'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_services.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_services.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'option_services.pdf'])->syncRoles([$Role1, $Role2]);
        //Permisos Compras de Opciones de Servicios
        Permission::create(['name' => 'option_services.create_buys'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'buys_services.pdf'])->syncRoles([$Role1, $Role2]);
        Permission::create(['name' => 'buys_services.anular'])->syncRoles([$Role1]);
        Permission::create(['name' => 'recepcionEntrega'])->syncRoles([$Role1]);
        


        //Permisos Proveedores
        Permission::create(['name' => 'providers'])->syncRoles([$Role1]); //Solo ver listado
        //Permission::create(['name' => 'providers.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'providers.destroy'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'providers.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'providers.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'providers.list'])->syncRoles([$Role1, $Role2]);

        //Permisos Usuarios
        Permission::create(['name' => 'users.index'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'users.store'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'users.update'])->syncRoles([$Role1]);
        //Permission::create(['name' => 'users.destroy'])->syncRoles([$Role1]);

        //Permisos Entrega de beneficio
        Permission::create(['name' => 'entrega'])->syncRoles([$Role1]);

        //Permisos Registro de pagos
        Permission::create(['name' => 'payment.indexNuevo'])->syncRoles([$Role1]);
    }
}
