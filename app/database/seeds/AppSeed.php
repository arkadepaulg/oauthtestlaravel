<?php

class AppSeed extends Seeder
{

    public function run()
    {
        DB::table('oauth_clients')->insert(
            array(
                'id' => 'abcd1234',
                'secret' => '1234',
                'name' => 'My test app',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );

        DB::table('oauth_client_endpoints')->insert(
            array(
                'id' => '1',
                'client_id' => 'abcd1234',
                'redirect_uri' => 'http://localhost:8000/reflect',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );


        DB::table('oauth_scopes')->insert(
            array(
                'id' => 'master_all',
                'description' => 'Master Scope',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );
    }

}