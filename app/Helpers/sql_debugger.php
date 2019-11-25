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

        // $sql = \Illuminate\Support\Str::replaceArray('?', $query->getBindings(), $query->toSql());

        $replace = function ($sql, $bindings)
        {
            $needle = '?';
            foreach ($bindings as $replace){
                $pos = strpos($sql, $needle);
                if ($pos !== false) {
                    if (gettype($replace) === "string") {
                        $replace = "'".addslashes($replace)."'";
                    }
                    $sql = substr_replace($sql, $replace, $pos, strlen($needle));
                }
            }
            return $sql;
        };
        $sql = $replace($query->toSql(), $query->getBindings());

        return $sql;
    }
}