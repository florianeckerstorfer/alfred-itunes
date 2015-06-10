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
        case 'musicTrack':
            return getTrackResultName($result);
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
    return sprintf(
        '%s - %s (%s)',
        $result['artistName'],
        $result['collectionName'],
        date('Y', strtotime($result['releaseDate']))
    );
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
function getTrackResultName($result)
{
    return sprintf(
        '%s - %s (%d)',
        $result['artistName'],
        $result['trackName'],
        date('Y', strtotime($result['releaseDate']))
    );
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

