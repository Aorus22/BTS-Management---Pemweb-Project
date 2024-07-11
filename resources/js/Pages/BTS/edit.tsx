import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";
import OpenStreetMaps from '@/Components/OpenStreetMaps';
import GoogleMap from "@/Components/GoogleMaps";

const Page: React.FC<PageProps> = ({ auth, databts,  wilayahLevel2, pemilik, jenisBts, pengguna }) => {
    const dropdown = {
        id_wilayah: wilayahLevel2 as [],
        id_pemilik: pemilik as[],
        id_jenis_bts: jenisBts as[],
        ada_genset: [{id: 1, nama:"true"}, {id:0, nama:"false"}],
        ada_tembok_batas : [{id: 1, nama:"true"}, {id:0, nama:"false"}]
    }

    const lokasiTower = [
        {lat: (databts as any).latitude, lng: (databts as any).longitude, name: (databts as any).nama}
    ]

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Data BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={databts as object} isNewForm={false} dropdown={dropdown} />
            </div>
            <div className="py-4 px-48">
                {(pengguna as any[]).length > 0 ? (
                    <div className="rounded-xl bg-white shadow-md p-4 px-16">
                        <p className="text-3xl font-bold text-gray-800 mb-2 text-center">Daftar Pengguna</p>
                        <ul className="divide-y divide-gray-200 text-lg font-semibold">
                            {(pengguna as any[]).map((penggunaItem, index) => (
                                <li key={index} className="py-2">
                                    <p>{index + 1}. {penggunaItem.nama}</p>
                                </li>
                            ))}
                        </ul>
                    </div>
                ) : (
                    <div className="bg-white rounded-xl shadow-md p-4 text-center">
                        <p className="text-3xl font-semibold text-gray-800 mb-2">Daftar Pengguna</p>
                        <p className="text-gray-500">Tower ini tidak memiliki pengguna bersama.</p>
                    </div>
                )}
            </div>

            <div className="px-24 mb-32">
                {/* <GoogleMap  latitude={data.latitude} longitude={data.longitude}/> */}
                <OpenStreetMaps coordinates={lokasiTower} zoom={9}/>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
