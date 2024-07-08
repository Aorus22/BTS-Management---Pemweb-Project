import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import React, {useState} from "react";
import DynamicForm from "@/Components/DynamicForm";

const Page: React.FC<PageProps> = ({ auth, wilayah, wilayahLevel1 }) => {
    const [data, setData] = useState(wilayah)

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
                <DynamicForm data={data as object} isNewForm={false} dropdown={dropdown} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
