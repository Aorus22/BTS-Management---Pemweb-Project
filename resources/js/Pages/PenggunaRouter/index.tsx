import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicTabel from "@/Components/DynamicTabel";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, pengguna_router }) => {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pengguna Router</h2>}
        >
            <div className="p-4">
                <DynamicTabel data={pengguna_router as []} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
