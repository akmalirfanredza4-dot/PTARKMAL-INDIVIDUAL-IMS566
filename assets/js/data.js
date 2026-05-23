const PTARKMAL = {
  credentials: {
    admin: { username: 'admin', password: '1234', role: 'admin', name: 'PTARKMAL Admin' },
    student: { username: 'student', password: '1234', role: 'user', name: 'Student User' }
  },
  books: [
    { id: 'B001', title: 'How to Take Care of Your Car', author: 'Harith Danish', category: 'Automotive', status: 'Available', description: 'A practical beginner-friendly guide written by famous car enthusiast Harith Danish, covering car care, maintenance habits, and simple troubleshooting.' },
    { id: 'B002', title: 'How to Cook Like a Pro', author: 'Chef Ariq Musa', category: 'Cooking', status: 'Available', description: 'Chef Ariq Musa shares easy professional cooking techniques, kitchen preparation tips, and ways to improve everyday meals.' },
    { id: 'B003', title: 'Footballer 101', author: 'Amirun Imran', category: 'Sports', status: 'Borrowed', description: 'Written by three-time Ballon d’Or winner Amirun Imran, this book introduces football basics, discipline, teamwork, and performance mindset.' },
    { id: 'B004', title: 'Kelantan Tourism', author: 'Iman Akmal Raziq Bin Zakri', category: 'Travel', status: 'Available', description: 'A colourful guide to Kelantan tourism, local culture, food, attractions, and travel highlights.' },
    { id: 'B005', title: 'Professional LARPer', author: 'Sir Alif Shazwann', category: 'Lifestyle', status: 'Reserved', description: 'Sir Alif Shazwann explains live-action role-playing, creative performance, costume preparation, and confidence-building.' },
    { id: 'B006', title: 'How to Be the Best', author: 'Tan Sri Akmal Irfan', category: 'Self Improvement', status: 'Available', description: 'Tan Sri Akmal Irfan presents motivational lessons about focus, discipline, learning from failure, and becoming the best version of yourself.' },
    { id: 'B007', title: 'Dr Cinta', author: 'Dr Danish Harith', category: 'Relationships', status: 'Borrowed', description: 'Dr Danish Harith writes a light-hearted guide about communication, respect, empathy, and understanding people better.' },
    { id: 'B008', title: 'How to Survive Bullying', author: 'Adam Chungs Haikal', category: 'Wellbeing', status: 'Available', description: 'Adam Chungs Haikal provides practical advice on staying safe, asking for help, building confidence, and handling bullying situations wisely.' }
  ],
  users: [
    { id: 'U001', name: 'Aina Sofea', role: 'Student', email: 'aina@student.ptarkmal.edu', status: 'Active' },
    { id: 'U002', name: 'Muhammad Faris', role: 'Student', email: 'faris@student.ptarkmal.edu', status: 'Active' },
    { id: 'U003', name: 'Nur Iman', role: 'Student', email: 'iman@student.ptarkmal.edu', status: 'Blocked' },
    { id: 'U004', name: 'PTARKMAL Admin', role: 'Admin', email: 'admin@ptarkmal.edu', status: 'Active' }
  ],
  borrowings: [
    { id: 'BR001', book: 'Footballer 101', borrower: 'Muhammad Faris', date: '2026-05-01', due: '2026-05-14', status: 'Borrowed' },
    { id: 'BR002', book: 'Dr Cinta', borrower: 'Aina Sofea', date: '2026-05-02', due: '2026-05-15', status: 'Borrowed' },
    { id: 'BR003', book: 'How to Cook Like a Pro', borrower: 'Nur Iman', date: '2026-04-20', due: '2026-05-03', status: 'Returned' },
    { id: 'BR004', book: 'Professional LARPer', borrower: 'Muhammad Faris', date: '2026-05-05', due: '2026-05-18', status: 'Reserved' }
  ],
  monthly: [12, 19, 15, 24, 31, 27],
  months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
};
