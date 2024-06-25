import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import {useState} from "react";

const Page: React.FC<PageProps> = ({ auth, pengguna_router }) => {
    const [data, setData] = useState(pengguna_router)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pengguna Router</h2>}
        >
            <div className="p-4">
                <DynamicForm data={data as object} isNewForm={false} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
