<?php

namespace TurnstileWeb\Ezidebit\Method;

/**
 * Interface MethodInterface
 * @package TurnstileWeb\Ezidebit\Method
 */
interface MethodInterface 
{
    /**
     * Inject and validate the request parameters
     *
     * @param array $parameters
     * @return MethodInterface
     */
    public function validate(array $parameters = array());

    /**
     * Make the request
     *
     * @param callable $success
     * @param callable $failure
     */
    public function request(Callable $success, Callable $failure);
}