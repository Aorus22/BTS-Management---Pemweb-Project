import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth }) => {
    const dataJenisBts = {
        nama: null
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Jenis BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={dataJenisBts} isNewForm={true} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
