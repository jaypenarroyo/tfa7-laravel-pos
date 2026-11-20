<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosPagesTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_all_required_pages_are_available(): void
    {
        $this->get('/')->assertOk()->assertSee('POS Foundations');
        $this->get('/about')->assertOk()->assertSee('Learning Laravel');
        $this->get('/customers')->assertOk()->assertSee('Customer Accounts')->assertSee('Maria Santos');
        $this->get('/users')->assertOk()->assertSee('User Accounts')->assertSee('cashier01');
    }
}
