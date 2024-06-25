import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";

const Page: React.FC<PageProps> = ({ auth}) => {
    const [data, setData] = useState({
        nama: "",
        alamat: "",
        telepon: ""
    })

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pemilik</h2>}
        >
            <div className="p-4">
                <DynamicForm data={data} isNewForm={true} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
