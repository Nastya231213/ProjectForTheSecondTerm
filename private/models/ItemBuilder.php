<?php 

/**
 * @file ItemBuilder.php
 * @brief Інтерфейс для побудови елементів з вибором розміру.
 */

/**
 * @interface ItemBuilder
 * @brief Інтерфейс для класів, які будують елементи з можливістю вибору розміру.
 */
interface ItemBuilder
{
    /**
     * @brief Вибирає розмір елемента.
     * 
     * @param string $size Розмір елемента.
     * @return ItemBuilder Повертає поточний екземпляр для ланцюгової побудови.
     */
    public function chooseSize($size);

    /**
     * @brief Завершує побудову елемента.
     * 
     * @return mixed Побудований елемент.
     */
    public function build();
}
