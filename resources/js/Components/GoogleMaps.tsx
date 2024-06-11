import React, { useEffect, useRef } from 'react';

type GMaps = {
    latitude: number,
    longitude: number
}

const GoogleMap: React.FC<GMaps> = ({latitude, longitude}) => {
    const mapRef = useRef<HTMLIFrameElement | null>(null);

    useEffect(() => {
        if (mapRef.current) {
            mapRef.current.src = `https://maps.google.com/maps?q=${latitude},${longitude}&hl=eng&output=embed`;
        }
    }, []);

    return (
        <>
            <iframe id="map_canvas" ref={mapRef} style={{ height: '400px', width: '100%' }} />
        </>
    );
};

export default GoogleMap;
