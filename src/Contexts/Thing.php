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

use Halfpastfour\Reddit\HttpMethod;
use Halfpastfour\Reddit\Interfaces\Context;
use Halfpastfour\Reddit\Reddit;

/**
 * Class Thing
 * @package Halfpastfour\Reddit\Contexts
 */
class Thing implements Context
{
	use ContextSetterTrait;
	use ContextGetterTrait;

	/**
	 * @var
	 */
	protected $client;

	/**
	 * Thing constructor.
	 *
	 * @param Reddit $p_oClient
	 * @param string $id
	 */
	public function __construct( Reddit $p_oClient, string $id )
	{
		$this->client              	= $p_oClient;
		$this->client->thingContext = $id;
	}

	/**
	 * Stickies the current post in the thread context.
	 *
	 * Semantic alias for setSubredditSticky(true, $num);
	 *
	 * @param int $num
	 *
	 * @return mixed
	 */
	public function stickyPost( int $num )
	{
		return $this->setSubredditSticky( true, $num );
	}

	/**
	 * Unstickies the current post in the thread context, if it is stickied.
	 *
	 * Semantic alias for setSubredditSticky(false);
	 *
	 * @return mixed
	 */
	public function unstickyPost()
	{
		return $this->setSubredditSticky( false );
	}

	/**
	 * For a given post in the thread context, either stickies it or unstickies it
	 * based on the boolean $state argument in the $num'th position (either 1 or 2).
	 *
	 * Direct one to one mapping with the "api/set_subreddit_sticky" Reddit call.
	 *
	 * @param bool $state
	 * @param int  $num
	 *
	 * @return mixed
	 */
	public function setSubredditSticky( bool $state, int $num = null )
	{
		$options['api_type'] = 'json';
		$options['id']       = $this->client->thingContext;
		$options['state']    = $state;

		if( !is_null( $num ) ) {
			$options['num'] = $num;
		}

		$response = $this->client->httpRequest( HttpMethod::POST, "api/set_subreddit_sticky", $options );
		return $response->getBody()->getContents();
	}

	/**
	 * Semantic alias of editUserText to make for more readable code.
	 *
	 * @param string $text
	 *
	 * @return mixed
	 */
	public function edit( string $text )
	{
		return $this->editUserText( $text );
	}

	/**
	 * Edit the body text of a comment or self-post.
	 *
	 * Accepts a parameter containing the raw markdown text to update the thing with. Expects a
	 * thing exists as a context before being called.
	 *
	 * @param $text
	 *
	 * @return mixed
	 */
	public function editUserText( string $text )
	{
		$options['api_type'] = 'json';
		$options['thing_id'] = $this->client->thingContext;
		$options['text']     = $text;

		$response = $this->client->httpRequest( HttpMethod::POST, "api/editusertext", $options );

		return json_decode( $response->getBody()->getContents() )['data'];
	}

	public function setFlair( array $options )
	{
	}
}