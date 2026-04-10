<?php

namespace Tests\Feature;

use Tests\TestCase;

class SupervisorPermissionTest extends TestCase
{
    public function test_user_maintenance_and_system_routes_are_hard_protected(): void
    {
        $usersRoute = app('router')->getRoutes()->getByName('admin.users.index');
        $this->assertNotNull($usersRoute);
        $this->assertContains('admin', $usersRoute->middleware());
        $this->assertContains('permission:manage-users', $usersRoute->middleware());

        $systemRoute = app('router')->getRoutes()->getByName('admin.import.index');
        $this->assertNotNull($systemRoute);
        $this->assertContains('admin', $systemRoute->middleware());
        $this->assertContains('permission:manage-system', $systemRoute->middleware());

        $uomRoute = app('router')->getRoutes()->getByName('admin.uom.index');
        $this->assertNotNull($uomRoute);
        $this->assertContains('permission:manage-uom', $uomRoute->middleware());

        $variationsRoute = app('router')->getRoutes()->getByName('admin.variations.index');
        $this->assertNotNull($variationsRoute);
        $this->assertContains('permission:manage-variations', $variationsRoute->middleware());

        $paymentTermsRoute = app('router')->getRoutes()->getByName('admin.payment-terms.index');
        $this->assertNotNull($paymentTermsRoute);
        $this->assertContains('permission:manage-payment-terms', $paymentTermsRoute->middleware());
    }

    public function test_supervisor_access_matrix_matches_required_permissions(): void
    {
        $supervisorPermissions = config('permissions.role_permissions.supervisor', []);

        $this->assertContains('view-dashboard', $supervisorPermissions);
        $this->assertContains('manage-products', $supervisorPermissions);
        $this->assertContains('manage-suppliers', $supervisorPermissions);
        $this->assertContains('manage-inventory', $supervisorPermissions);
        $this->assertContains('manage-sales', $supervisorPermissions);
        $this->assertContains('view-reports', $supervisorPermissions);

        $this->assertNotContains('manage-users', $supervisorPermissions);
        $this->assertNotContains('manage-system', $supervisorPermissions);
        $this->assertNotContains('manage-uom', $supervisorPermissions);
        $this->assertNotContains('manage-variations', $supervisorPermissions);
        $this->assertNotContains('manage-payment-terms', $supervisorPermissions);
    }
}
