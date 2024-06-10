import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Tabel from "@/Components/DynamicTabel";
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";
import {data} from "autoprefixer";

const Page: React.FC<PageProps> = ({ auth, jenisBts }) => {
    const [dataJenisBts, setDataJenisBts] = useState(jenisBts)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Jenis BTS</h2>}
        >
            <div className="p-4">
                <DynamicForm data={dataJenisBts as object} isNewForm={false} setData={setDataJenisBts} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
