import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, pemilik }) => {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pemilik</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={pemilik as object} isNewForm={false}  />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
