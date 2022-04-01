<?php

namespace Webkul\Velocity;

use Webkul\Category\Repositories\CategoryRepository;

class Velocity
{
    /**
     * Content Type List
     *
     * @var array
     */
	protected $content_type = [
        // 'link'     => 'Link CMS Page',
        // 'product'  => 'Catalog Products',
        // 'static'   => 'Static Content',
        'category' => 'Category Slug',
    ];

    /**
     * Catalog Product Type
     *
     * @var array
     */
	protected $catalog_type = [
        'new'     => 'Nuevo ingreso',
        'offer'   => 'Producto ofertado [Special]',
        'popular' => 'Productos Populares',
        'viewed'  => 'Más Visitados',
        'rated'   => 'Mejor Calificados',
        'custom'  => 'Selección personalizada',
    ];

	/**
	 * CategoryRepository object
	 *
	 * @var \Webkul\Category\Repositories\CategoryRepository
	 */
	protected $categoryRepository;

    /**
     * Create a new instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
		return $this->content_type;
    }

    /**
     * @return string
     */
    public function getCatalogType()
    {
		return $this->catalog_type;
    }
}