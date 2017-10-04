<?php

/**
 * Dépôt pour GDS
 *
 * @author Yvon Benahita
 */

namespace GDS\Upsert;

use GDS\Schema;
use GDS\Store;

class Repository
{

    /**
     * Instance de Memcache
     *
     * @var \Memcached|null
     */
    private $obj_cache = NULL;

    /**
     * Instance du magasin GDS
     *
     * @var Store|null
     */
    private $obj_store = NULL;

    /**
     * @return \Memcached|null
     */
    private function getCache()
    {
        if(NULL === $this->obj_cache) {
            $this->obj_cache = new \Memcached();
        }
        return $this->obj_cache;
    }

    /**
     * Mettre à jour le cache de Datastore (pour l'affichage brute des 10 dernières valeurs)
     *
     * @return array
     */
    private function updateCache()
    {
        $obj_store = $this->getStore();

        $arr_posts = $obj_store->query("SELECT * FROM zone_1 ORDER BY posted DESC")->fetchPage(10);

        $this->getCache()->set('recent', $arr_posts);

        return $arr_posts;
    }

    /**
     * Insèrez l'entité (dans la table)
     *
     * @param $str_co2
     * @param $str_co
     * @param $str_nh3
     */
    public function createPost($str_co2, $str_co, $str_nh3)
    {
        $obj_store = $this->getStore();

        $obj_store->upsert($obj_store->createEntity([
            'posted' => date('Y-m-d H:i:s'),
            'co2' => $str_co2,
            'co' => $str_co,
            'nh3' => $str_nh3
        ]));

        // Mettre à jour le cache
        $this->updateCache();
    }

    /**
     * Configuration et retourner un magasin (Store ie La BDD)
     *
     * @return Store
     */
    private function getStore()
    {
        if(NULL === $this->obj_store) 
            {
                $this->obj_store = new Store($this->makeSchema());
            }

        return $this->obj_store;
    }

    /**
     * Créez un schéma pour les entrées (on peut dire Table)
     *
     * 'posted' est l'heure de la date d'entrée des valeurs 
     *
     * @return Schema
     */
    private function makeSchema()
    {
        return (new Schema('zone_1'))
            ->addDatetime('posted')
            ->addString('co2', FALSE)
            ->addString('co', FALSE)
            ->addString('nh3', FALSE)
        ;
    }

}