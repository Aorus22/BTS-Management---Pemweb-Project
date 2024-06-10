import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Tabel from "@/Components/Tabel";

interface JenisBts {
    id: number;
    nama: string;
    createdBy: string;
    created_at: string;
}

interface PageProps {
    auth: any;
    jenisBts: JenisBts[];
}

const Page: React.FC<PageProps> = ({ auth, jenisBts }) => {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Jenis BTS</h2>}
        >
            <div className="p-4">
                <Tabel apiUrl={"test"} data={jenisBts} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
