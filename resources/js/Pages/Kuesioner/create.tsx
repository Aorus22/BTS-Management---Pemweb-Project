import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";

const Page: React.FC<PageProps> = ({ auth, wilayahLevel1}) => {
    const [data, setData] = useState({
        nama: "",
        id_parent: "",
        level: "",
    })

    const dropdown = {
        id_parent: wilayahLevel1 as [],
        level: [{id: 1, nama:"1"}, {id: 2, nama:"2"}]
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Wilayah</h2>}
        >
            <div className="p-4">
                <DynamicForm data={data} isNewForm={true} setData={setData} dropdown={dropdown} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
