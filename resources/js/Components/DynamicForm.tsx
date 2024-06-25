import React, { useState } from 'react';
import { useForm, usePage } from '@inertiajs/react';

export type DropdownOption = {
    id: number;
    nama: string;
};

export type Dropdown = {
    [key: string]: DropdownOption[];
};

export type FormDataCustom = {
    [key: string]: any;
};

interface DynamicFormProps {
    isNewForm: boolean;
    data: FormDataCustom;
    dropdown?: Dropdown;
}

const formatLabel = (key: string) => {
    return key.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
};

const DynamicForm: React.FC<DynamicFormProps> = ({ isNewForm, data, dropdown }) => {
    const pathname = usePage().url.split('/').slice(0, 2).join('/');
    const { data: formData, setData, post, put, processing, errors } = useForm<FormDataCustom>(data);
    const [isEditMode, setIsEditMode] = useState(isNewForm);
    const [initialData] = useState<FormDataCustom>(data);

    const toggleEditMode = () => {
        if (isEditMode) {
            setData(initialData);
        }
        setIsEditMode(!isEditMode);
    };

    if (!formData) {
        return <p className="text-center p-4">Tidak ada data yang tersedia.</p>;
    }

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(`${pathname}`);
    };

    const handleUpdate = (e: React.FormEvent) => {
        e.preventDefault();
        put(`${pathname}/${formData.id}`);
    };

    const getInputType = (key: string): string => {
        const value = formData[key];

        if (typeof value === 'number') {
            return 'number';
        } else if (typeof value === 'string') {
            return 'text';
        } else if (value instanceof Date) {
            return 'datetime-local';
        }
        return 'text';
    };

    return (
        <div className="bg-gradient-to-b from-white to-gray-50 rounded-xl p-12 mt-4">
            {!isNewForm && (
                <div className="mb-4 flex space-x-2">
                    <button
                        type="button"
                        onClick={toggleEditMode}
                        className={`px-4 py-2 ${isEditMode ? 'bg-gradient-to-r from-red-600 to-red-800' : 'bg-gradient-to-r from-[#2c3f79] to-[#3b5998]'} text-white rounded`}
                    >
                        {isEditMode ? 'Cancel' : 'Edit'}
                    </button>
                    {isEditMode && (
                        <button
                            type="button"
                            onClick={handleUpdate}
                            className="px-4 py-2 bg-gradient-to-r from-green-600 to-green-800 text-white rounded"
                            disabled={processing}
                        >
                            Save
                        </button>
                    )}
                </div>
            )}
            <form onSubmit={isNewForm ? handleSubmit : handleUpdate}>
                {Object.keys(formData).map((key) => (
                    <div key={key} className={`mb-4 ${isNewForm && key === 'id' ? 'hidden' : ''}`}>
                        <label
                            className={`block text-gray-700 text-lg font-bold mb-2 ${isNewForm && key === 'id' ? 'hidden' : ''}`}
                            htmlFor={key}>
                            {formatLabel(key)}
                        </label>
                        {dropdown && dropdown.hasOwnProperty(key) ? (
                            <select
                                name={key}
                                value={formData[key]}
                                onChange={(e) => setData(key, e.target.value)}
                                className={`shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg ${!isEditMode ? 'bg-gray-200 cursor-not-allowed' : ''}`}
                                disabled={!isEditMode}
                            >
                                <option value="">Pilih {formatLabel(key)}</option>
                                {dropdown[key].map((option: DropdownOption) => (
                                    <option key={option.id} value={option.id}>{option.nama}</option>
                                ))}
                            </select>
                        ) : (
                            <input
                                type={getInputType(key)}
                                name={key}
                                value={getInputType(key) === 'datetime-local' ? (new Date(formData[key]).toISOString().slice(0, 16)) : (formData[key])}
                                onChange={(e) => setData(key, e.target.value)}
                                className={`shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg ${!isEditMode || key === 'id' ? 'bg-gray-200 cursor-not-allowed' : ''}`}
                                hidden={isNewForm && key === 'id'}
                                disabled={!isEditMode || key === 'id'}
                            />
                        )}
                        {errors[key] && <div className="text-red-500 text-xs mt-1">{errors[key]}</div>}
                    </div>
                ))}

                {isNewForm && (
                    <button
                        type="submit"
                        className="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded text-lg"
                        disabled={processing}
                    >
                        Submit
                    </button>
                )}
            </form>
        </div>
    );
};

export default DynamicForm;
