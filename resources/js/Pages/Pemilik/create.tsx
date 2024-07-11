import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth }) => {
    const data = {
        nama: null,
        alamat: null,
        telepon: null
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pemilik</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
