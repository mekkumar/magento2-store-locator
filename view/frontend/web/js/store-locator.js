define(['jquery'], function ($) {
    'use strict';

    return function (config, element) {
        var stores = config.stores || [];
        var mapConfig = config.mapConfig || {};
        var markerSize = 32;
        var activeMarkerSize = 32;

        /**
         * Prepare a marker icon with a controlled size.
         */
        function getMarkerIcon(iconUrl, size) {
            if (!iconUrl) {
                return undefined;
            }

            // Preserve existing Google Maps icon configuration.
            if (typeof iconUrl === 'object') {
                var iconConfig = $.extend({}, iconUrl);

                iconConfig.scaledSize = new google.maps.Size(size, size);
                iconConfig.anchor = new google.maps.Point(
                    size / 2,
                    size
                );

                return iconConfig;
            }

            return {
                url: iconUrl,
                scaledSize: new google.maps.Size(size, size),
                anchor: new google.maps.Point(size / 2, size)
            };
        }

        /**
         * Get the default marker icon for a store.
         */
        function getStoreMarkerIcon(store, active) {
            var iconUrl;

            if (active) {
                iconUrl =
                    store.active_marker_icon ||
                    mapConfig.active_marker ||
                    store.marker_icon ||
                    mapConfig.default_marker;
            } else {
                iconUrl =
                    store.marker_icon ||
                    mapConfig.default_marker;
            }

            return getMarkerIcon(
                iconUrl,
                active ? activeMarkerSize : markerSize
            );
        }

        function init() {
            var defaultLat =
                parseFloat(mapConfig.default_latitude) || 52.520008;
            var defaultLng =
                parseFloat(mapConfig.default_longitude) || 13.404954;
            var first = stores[0];
            var radius = Math.max(
                1,
                parseFloat(mapConfig.default_radius) || 25
            );
            var defaultZoom = Math.max(
                3,
                Math.min(
                    15,
                    Math.round(15 - Math.log(radius) / Math.LN2)
                )
            );

            var firstLat = first ? parseFloat(first.latitude) : defaultLat;
            var firstLng = first ? parseFloat(first.longitude) : defaultLng;

            var map = new google.maps.Map(element, {
                center: {
                    lat: Number.isFinite(firstLat) ? firstLat : defaultLat,
                    lng: Number.isFinite(firstLng) ? firstLng : defaultLng
                },
                zoom: first ? 12 : defaultZoom
            });

            var infoWindow = new google.maps.InfoWindow();
            var markers = {};

            stores.forEach(function (store) {
                var latitude = parseFloat(store.latitude);
                var longitude = parseFloat(store.longitude);

                if (
                    !Number.isFinite(latitude) ||
                    !Number.isFinite(longitude)
                ) {
                    return;
                }

                var marker = new google.maps.Marker({
                    map: map,
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    title: store.name || '',
                    icon: getStoreMarkerIcon(store, false)
                });

                markers[store.entity_id] = marker;

                marker.addListener('click', function () {
                    Object.keys(markers).forEach(function (id) {
                        var currentStore = stores.find(function (item) {
                            return String(item.entity_id) === String(id);
                        });

                        if (currentStore) {
                            markers[id].setIcon(
                                getStoreMarkerIcon(currentStore, false)
                            );
                        }
                    });

                    marker.setIcon(getStoreMarkerIcon(store, true));
                    var storeImage = store.logo || store.marker_icon || '';

                    var content =
                        '<div class="kumar-map-info">' +
                        (
                            storeImage
                                ? '<div class="kumar-map-info-image">' +
                                    '<img src="' +
                                    $('<div>').text(storeImage).html() +
                                    '" alt="' +
                                    $('<div>').text(store.name || '').html() +
                                    '" style="height: 50px; width: 50px;">' +
                                '</div>'
                                : ''
                        ) +
                        '<strong>' +
                        $('<div>').text(store.name || '').html() +
                        '</strong><br>' +
                        $('<div>').text(store.address || '').html() +
                        '<br>' +
                        $('<div>').text(
                            [
                                store.postcode || '',
                                store.city || ''
                            ].filter(Boolean).join(' ')
                        ).html() +
                        (
                            store.phone
                                ? '<br><a href="tel:' +
                                    $('<div>').text(store.phone).html() +
                                    '">' +
                                    $('<div>').text(store.phone).html() +
                                    '</a>'
                                : ''
                        ) +
                        '</div>';

                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);

                    $('.kumar-store-card').removeClass('active');

                    $('.kumar-store-card').filter(function () {
                        return String($(this).data('store-id')) ===
                            String(store.entity_id);
                    }).addClass('active');
                });
            });

            $('.kumar-store-card')
                .off('click.kumarStoreLocator')
                .on('click.kumarStoreLocator', function () {
                    var id = $(this).data('store-id');
                    var marker = markers[id];

                    if (marker) {
                        map.panTo(marker.getPosition());
                        map.setZoom(15);
                        google.maps.event.trigger(marker, 'click');
                    }
                });

            $('#kumar-store-search-btn')
                .off('click.kumarStoreLocator')
                .on('click.kumarStoreLocator', filterStores);

            $('#kumar-store-search')
                .off('keydown.kumarStoreLocator')
                .on('keydown.kumarStoreLocator', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        filterStores();
                    }
                });

            function filterStores() {
                var query = String(
                    $('#kumar-store-search').val() || ''
                ).toLowerCase();

                $('.kumar-store-card').each(function () {
                    var matches = $(this)
                        .text()
                        .toLowerCase()
                        .indexOf(query) !== -1;

                    $(this).toggle(matches);
                });
            }

            if (stores.length === 0) {
                map.setCenter({
                    lat: defaultLat,
                    lng: defaultLng
                });
                map.setZoom(defaultZoom);
            }
        }

        if (config.googleMapsKey) {
            var script = document.createElement('script');

            script.src =
                'https://maps.googleapis.com/maps/api/js?key=' +
                encodeURIComponent(config.googleMapsKey);

            script.async = true;
            script.defer = true;
            script.onload = init;

            script.onerror = function () {
                $(element).html(
                    '<div class="kumar-store-error">' +
                    'Google Maps could not be loaded. Please try again later.' +
                    '</div>'
                );
            };

            document.head.appendChild(script);
        } else {
            $(element).html(
                '<div class="kumar-store-error">' +
                'Google Maps API key is not configured.' +
                '</div>'
            );
        }
    };
});