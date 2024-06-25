import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicTabel from "@/Components/DynamicTabel";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, kuesioner }) => {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Kuesioner</h2>}
        >
            <div className="p-4">
                <DynamicTabel data={kuesioner as []} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
