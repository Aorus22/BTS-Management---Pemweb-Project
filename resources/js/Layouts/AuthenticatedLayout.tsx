import { useState, PropsWithChildren, ReactNode } from 'react';
import { User } from '@/types';
import Sidebar from "@/Components/Sidebar";

export default function Authenticated({ user, header, children }: PropsWithChildren<{ user: User, header?: ReactNode }>) {
    return (
        <div className="h-screen flex">
            <Sidebar user={user} />
            <div className="flex flex-col flex-1 ml-64 overflow-auto">
                {header && (
                    <header className="bg-white shadow">
                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
                    </header>
                )}
                <div className={"bg-gradient-to-b from-gray-200 to-gray-200 h-full"}>
                    {children}
                </div>
            </div>
        </div>
    );
}
