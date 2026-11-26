<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class PageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #[TestWith(['/'])]
    #[TestWith(['/layanan'])]
    #[TestWith(['/tentang-kami'])]
    public function test_hero_pages_render_sticky_dark_navbar_and_animated_mobile_menu(string $uri): void
    {
        $response = $this->get($uri);

        $response->assertOk()
            ->assertSee('sticky top-0 z-50 h-0', false)
            ->assertSee('data-nav', false)
            ->assertSee('data-dark="true"', false)
            ->assertSee('data-menu-backdrop', false)
            ->assertSee('data-menu-toggle', false)
            ->assertSee('data-menu-item', false);
    }

    public function test_product_page_renders_sticky_light_navbar_and_animated_mobile_menu(): void
    {
        $slug = array_key_first(config('site.products'));

        $response = $this->get(route('services.show', $slug));

        $response->assertOk()
            ->assertSee('sticky top-0 z-50', false)
            ->assertSee('data-nav', false)
            ->assertSee('data-dark="false"', false)
            ->assertSee('data-menu-backdrop', false)
            ->assertSee('data-menu-toggle', false)
            ->assertSee('data-menu-item', false);
    }

    public function test_home_page_renders_interactive_coverage_map_for_tangerang_and_purwokerto_hubs(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('data-coverage-map', false)
            ->assertSee('data-map-dots="tangerang"', false)
            ->assertSee('data-map-dots="purwokerto"', false)
            ->assertSee('data-map-pin="tangerang"', false)
            ->assertSee('data-map-pin="purwokerto"', false)
            ->assertSee('data-map-pin="banyumas"', false)
            ->assertSee('data-map-pin="purbalingga"', false)
            ->assertSee('data-map-pin="cilacap"', false)
            ->assertSee('data-map-pin="kebumen"', false);
    }
}
