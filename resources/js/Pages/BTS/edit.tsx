import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";
import OpenStreetMaps from '@/Components/OpenStreetMaps';
import GoogleMap from "@/Components/GoogleMaps";

const Page: React.FC<PageProps> = ({ auth, databts,  wilayahLevel2, pemilik, jenisBts }) => {
    const [data, setData] = useState(databts as any)

    const dropdown = {
        id_wilayah: wilayahLevel2 as [],
        id_pemilik: pemilik as[],
        id_jenis_bts: jenisBts as[],
        ada_genset: [{id: 1, nama:"true"}, {id:0, nama:"false"}],
        ada_tembok_batas : [{id: 1, nama:"true"}, {id:0, nama:"false"}]
    }

    const lokasiTower = [
        {lat: data.latitude, lng: data.longitude, name: data.nama}
    ]

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Data BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data as object} isNewForm={false} dropdown={dropdown} />
            </div>
            <div className="px-24 mb-32">
                {/* <GoogleMap  latitude={data.latitude} longitude={data.longitude}/> */}
                <OpenStreetMaps coordinates={lokasiTower} zoom={9}/>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
