import React, { useEffect, useRef } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export interface MapsProps {
    coordinates: { lat: number, lng: number, name: string }[];
    zoom: number;
}

const MapComponent: React.FC<MapsProps> = ({ coordinates, zoom }) => {
    const mapRef = useRef<HTMLDivElement | null>(null);

    useEffect(() => {
        if (mapRef.current) {
            const map = L.map(mapRef.current).setView(
                coordinates.length === 1
                    ? [coordinates[0].lat, coordinates[0].lng]
                    : [-6.2088, 106.8456],
                zoom
            );

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            coordinates.forEach((coord) => {
                const marker = L.marker([coord.lat, coord.lng]).addTo(map);
                marker.bindPopup(coord.name);
            });

            return () => {
                map.remove();
            };
        }
    }, [coordinates, zoom]);

    return (
        <>
            {coordinates && coordinates.length > 0 ? (
                <div ref={mapRef} style={{ height: '600px', width: '100%' }} />
            ) : (
                <div className='bg-white font-semibold text-gray-700 w-full h-[200px] flex justify-center items-center'>
                    <p>Data koordinat tidak tersedia.</p>
                </div>
            )}
        </>
    );
};

export default MapComponent;
