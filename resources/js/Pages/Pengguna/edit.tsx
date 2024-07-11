import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import {useState} from "react";

const Page: React.FC<PageProps> = ({ auth, pengguna_bts, bts }) => {
    const dropdown = {
        id_bts: bts as [],
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pengguna BTS</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={pengguna_bts as object} isNewForm={false} dropdown={dropdown} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
