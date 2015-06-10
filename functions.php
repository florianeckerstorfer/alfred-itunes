<?php

/**
 * @param string $entity
 * @param array  $result
 *
 * @return string
 */
function getResultName($entity, $result)
{
    switch ($entity) {
        case 'album':
            return getAlbumResultName($result);
        case 'musicArtist':
            return getArtistResultName($result);
        case 'software':
            return getSoftwareResultName($result);
        case 'macSoftware':
            return getSoftwareResultName($result);
    }

    return 'Unknown item';
}

/**
 * @param array $result
 *
 * @return string
 */
function getAlbumResultName($result)
{
    return sprintf('%s - %s', $result['artistName'], $result['collectionName']);
}

/**
 * @param array $result
 *
 * @return string
 */
function getArtistResultName($result)
{
    return $result['artistName'];
}

/**
 * @param array $result
 *
 * @return string
 */
function getSoftwareResultName($result)
{
    return $result['trackName'];
}

