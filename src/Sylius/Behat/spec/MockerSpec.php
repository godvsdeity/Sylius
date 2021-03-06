<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Behat;

use Payum\Core\Bridge\Guzzle\HttpClient;
use PhpSpec\ObjectBehavior;
use PSS\SymfonyMockerContainer\DependencyInjection\MockerContainer;
use Sylius\Behat\MockerInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class MockerSpec extends ObjectBehavior
{
    function let(MockerContainer $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Behat\Mocker');
    }

    function it_implements_behat_mocker_interface()
    {
        $this->shouldImplement(MockerInterface::class);
    }

    function it_mocks_given_service($container)
    {
        $container->mock('payum.http_client', HttpClient::class)->shouldBeCalled();

        $this->mockService('payum.http_client', HttpClient::class);
    }

    function it_mocks_collaborator()
    {
        $this->mockCollaborator(HttpClient::class)->shouldHaveType('\Mockery\MockInterface');
    }
}
