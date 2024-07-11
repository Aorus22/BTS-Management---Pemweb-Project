import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, bts }) => {
    const data = {
        nama: null,
        alamat: null,
        telepon: null,
        id_bts: null
    }

    const dropdown = {
        id_bts: bts as [],
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pengguna BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} dropdown={dropdown} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
