import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, jenisBts }) => {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Jenis BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={jenisBts as object} isNewForm={false} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
