import React from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';

export interface MapsProps {
    coordinates: { lat: number, lng: number, name: string }[];
    zoom: number;
}

const MapComponent: React.FC<MapsProps> = ({ coordinates, zoom }) => {

    let center: [number, number];

    if (coordinates.length === 1) {
        center = [coordinates[0].lat, coordinates[0].lng];
    } else {
        center = [-6.2088, 106.8456];
    }

    return (
        <>
            {coordinates && coordinates.length > 0 && (
                    // @ts-ignore
                <MapContainer center={center} zoom={zoom} style={{ height: '600px', width: '100%' }}>
                    <TileLayer
                    // @ts-ignore
                        attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    />
                    {coordinates.map((coord, index) => (
                        <Marker key={index} position={[coord.lat, coord.lng]}>
                            <Popup>{coord.name}</Popup>
                        </Marker>
                    ))}
                </MapContainer>
            )}
            {(!coordinates || coordinates.length === 0) && (
                <div className='bg-white font-semibold text-gray-700 w-full h-[200px] flex justify-center items-center'>
                <p>Data koordinat tidak tersedia.</p>
            </div>
            )}
        </>
    );
};

export default MapComponent;
