import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import React, {useState} from "react";
import {usePage} from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, id_kuesioner}) => {
    const [data, setData] = useState({
        id_kuesioner: id_kuesioner,
        pilihan_jawaban: "",
    })

    const pathname = usePage().url.split('/').slice(0, 3).join('/');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pilihan Kuesioner</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data} isNewForm={true} customPath={`${pathname}/data-pilihan-kuesioner`} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
