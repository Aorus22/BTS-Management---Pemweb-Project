import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm from "@/Components/DynamicForm";
import {useState} from "react";

const Page: React.FC<PageProps> = ({ auth, pemilik }) => {
    const [data, setData] = useState(pemilik)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Pemilik</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data as object} isNewForm={false}  />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
