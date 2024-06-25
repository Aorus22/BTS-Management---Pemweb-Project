import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";
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

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Jenis BTS</h2>}
        >
            <div className="p-4">
                <DynamicForm data={data as object} isNewForm={false} dropdown={dropdown} />
            </div>
            <div className="p-4">
                <GoogleMap  latitude={data.latitude} longitude={data.longitude}/>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
