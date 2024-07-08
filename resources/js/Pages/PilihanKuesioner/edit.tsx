import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import React, {useState} from "react";
import DynamicForm from "@/Components/DynamicForm";
import kuesioner from "@/Pages/Kuesioner/index";
import DynamicTabel from "@/Components/DynamicTabel";
import {usePage} from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, pilihan_kuesioner }) => {
    const [data, setData] = useState(pilihan_kuesioner)

    const pathname = usePage().url.split('/').slice(0, 3).join('/');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pilihan Kuesioner</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data as object} customPath={`${pathname}/data-pilihan-kuesioner`} isNewForm={false}  />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
