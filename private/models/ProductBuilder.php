<?php

/**
 * @file ProductBuilder.php
 * @brief Конкретна реалізація інтерфейсу ItemBuilder для побудови продуктів.
 */
/**
 * @class ProductBuilder
 *  @brief Клас ProductBuilder для побудови продуктів.
 */
class ProductBuilder implements ItemBuilder
{
    /**
     * @var Product $product Об'єкт продукту, який будується.
     */
    private $product;

    /**
     * Конструктор класу ProductBuilder.
     *
     * @param Product $dessert Початковий об'єкт продукту (наприклад, десерт), на основі якого будується об'єкт.
     */
    public function __construct($dessert)
    {
        $this->product = $dessert;
    }

    /**
     * Встановлює розмір продукту.
     *
     * @param string $size Розмір, який потрібно встановити для продукту.
     * @return ProductBuilder Повертає поточний екземпляр ProductBuilder для ланцюгового виклику методів.
     */
    public function chooseSize($size)
    {
        $this->product->setSize($size);
        return $this;
    }

    /**
     * Побудова та повернення готового об'єкта продукту.
     *
     * @return Product Повертає повністю побудований об'єкт продукту.
     */
    public function build()
    {
        return $this->product;
    }
}
