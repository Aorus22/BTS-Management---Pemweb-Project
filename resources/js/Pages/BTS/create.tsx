import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, wilayahLevel2, pemilik, jenisBts }) => {
    const data = {
        nama: null,
        alamat: null,
        latitude: null,
        longitude: null,
        tinggi_tower: null,
        panjang_tanah: null,
        lebar_tanah: null,
        ada_genset: null,
        ada_tembok_batas: null,
        id_jenis_bts: null,
        id_pemilik: null,
        id_wilayah: null
    }

    const inputType = {
        latitude: "number",
        longitude: "number",
        tinggi_tower: "number",
        panjang_tanah: "number",
        lebar_tanah: "number",
    };

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
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Data BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} dropdown={dropdown} inputType={inputType} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
