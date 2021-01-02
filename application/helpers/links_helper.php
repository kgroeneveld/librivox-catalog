<?php

// build various links for rss, torrents, iarchive, etc

function torrent_link($url_iarchive = '')
{
	if (empty($url_iarchive)) return '';

	// sample link: http://www.archive.org/details/woman_as_decoration_0910_librivox
	// sample torrent: http://www.archive.org/download/woman_as_decoration_0910_librivox/woman_as_decoration_0910_librivox_archive.torrent

	$archive_torrent_link = "http://www.archive.org/download/";

	$url_iarchive = str_replace('www.', '', $url_iarchive);
	$url_iarchive = str_replace('http://archive.org/details/', '', $url_iarchive);
	$torrent_ext = '_archive.torrent';

	if (strlen(trim($url_iarchive)) == 0) return '';

	return $archive_torrent_link . $url_iarchive . '/' . $url_iarchive . $torrent_ext;

}

function rss_link()
{
	//https://librivox.org/rss/6792


}

function itunes_subscribe_link()
{
	//itpc://librivox.org/rss/6792

}

function http_to_https($url)
{
	/* Some URLs are stored in the database as http. But when they are used
	   for things like <img> this can cause the web browser to give scary
	   warnings about mixed encrypted/un-encrypted content. But simply upgrading
	   all URLs to https could cause an issue if it is a link to a server that
	   does not support https. So this function only upgrades URLs for a
	   specific list of host names. */

	// test for http and extract host name
	if (preg_match('!^http://([^/]*)!', $url, $match))
	{
		// test for host names we want to upgrade to https
		if (preg_match('/(archive.org)/', $match[1]))
			return 'https' . substr($url, 4);
	}

	return $url;
}
