<?php
/**
 * Copyright (c) 2016 halfpastfour.am
 * MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Halfpastfour\Reddit\Contexts;

use Halfpastfour\Reddit\Reddit;

/**
 * Class ContextSetterTrait
 * @package Halfpastfour\Reddit\Contexts
 * @property Reddit $client
 */
trait ContextSetterTrait
{
	/**
	 * Sets the user context for future method calls.
	 *
	 * @param   string $user The user to set the context for.
	 *
	 * @return  User
	 */
	public function user( string $user ) : User
	{
		return new User( $this->client, $user );
	}

	/**
	 * Sets the subreddit context for future method calls.
	 *
	 * @param string $subreddit The subreddit to set the context for.
	 *
	 * @return Subreddit
	 */
	public function subreddit( string $subreddit ) : Subreddit
	{
		return new Subreddit( $this->client, $subreddit );
	}

	/**
	 * Sets the thing context for future method calls.
	 *
	 * @param string $thingId The thing to set the context for.
	 *
	 * @return Thing
	 */
	public function thing( string $thingId ) : Thing
	{
		return new Thing( $this->client, $thingId );
	}

	/**
	 * Sets the private message context for future method calls
	 *
	 * @param string $messageId
	 *
	 * @return PrivateMessage
	 */
	public function privateMessage( string $messageId ) : PrivateMessage
	{
		return new PrivateMessage( $this->client, $messageId );
	}
}