import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";

const Page: React.FC<PageProps> = ({ auth}) => {
    const [data, setData] = useState({
        pertanyaan: "",
    })

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Kuesioner</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
