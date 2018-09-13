<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;
use Closure;

/**
 * Description of AbstractMiddleware
 *
 * @author Ervin
 */
class AbstractMiddleware {

    /**
     * A global message to be shown to the user if he
     * is not authorized to view incoming request.
     *
     * @var string
     */
    protected $_deniedMsg;

    /**
     * AbstractMiddleware Constructor.
     *
     * @return void
     */
    public function __construct() {
        $this->_deniedMsg = \trans('user.You are not authorized to view this content!');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null) {




        $user = \Auth::user();

        /**
         * Check if the user is logged in
         */
        if (!\Auth::check()) {

            if ($request->ajax()) {
                throw new AccessDeniedHttpException($this->_deniedMsg);
            }
            $loginRoute = route('login');
            return redirect()->guest($loginRoute)->with('error', $this->_deniedMsg);
        }


        if (!$permission) {
            $permission = $request->path();
            if (\App::environment('local')) {
                $this->_deniedMsg .= " <br /><i>local env msg</i>: [{$permission}]";
            }
            if (!$user->hasPathPermission($permission, $request)) {
                return response($this->_deniedMsg, 403);
            }
        } else {
            if (!$user->hasPermission($permission)) {
                return response($this->_deniedMsg, 403);
            }
        }

        return $next($request);
    }

}
