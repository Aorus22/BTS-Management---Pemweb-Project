import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";

const Page: React.FC<PageProps> = ({ auth, wilayahLevel2, pemilik, jenisBts}) => {
    const [data, setData] = useState({
        nama: "",
        alamat: "",
        latitude: 0.0,
        longitude: 0.0,
        tinggi_tower: 0.0,
        panjang_tanah: 0.0,
        lebar_tanah: 0.0,
        ada_genset: false,
        ada_tembok_batas: false,
        id_jenis_bts: null,
        id_pemilik: null,
        id_wilayah: null
    })

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
                <DynamicForm data={data} isNewForm={true} dropdown={dropdown}/>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
