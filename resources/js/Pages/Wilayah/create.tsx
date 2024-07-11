import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React from "react";

const Page: React.FC<PageProps> = ({ auth, wilayahLevel1 }) => {
    const data= {
        nama: null,
        id_parent: null,
        level: null,
    }

    const dropdown = {
        id_parent: wilayahLevel1 as [],
        level: [{id: 1, nama:"1"}, {id: 2, nama:"2"}]
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Wilayah</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} dropdown={dropdown} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
