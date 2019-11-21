<?php

// Muhammad Shakirin Samin - 21/11/2019 - getRawSql
if (!function_exists('getRawSql')) {
    function getRawSql($query)
    {
        /**
         * ============================
         *    Sample from Controller
         * ============================
         * - Using Eloquent:
         *      $query = User::where('id', 1);
         *      dd(getRawSql($query));
         *          => Output: "select * from `users` where `id` = 1"
         * 
         * - Using Query Builder:
         *      $query = DB::table('users')->select('name')->where('id', 1);
         *      dd(getRawSql($query));
         *          => Output: "select `name` from `users` where `id` = 1"
         */

        $sql = \Illuminate\Support\Str::replaceArray('?', $query->getBindings(), $query->toSql());
        return $sql;
    }
}