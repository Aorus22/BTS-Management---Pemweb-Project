import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Tabel from "@/Components/DynamicTabel";
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import {useState} from "react";
import {data} from "autoprefixer";

const Page: React.FC<PageProps> = ({ auth, pemilik }) => {
    const [data, setData] = useState(pemilik)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pemilik</h2>}
        >
            <div className="p-4">
                <DynamicForm data={data as object} isNewForm={false} setData={setData} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
